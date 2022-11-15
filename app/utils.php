<?php
function createToken() {
    $seed = urlSafeEncode(random_bytes(8));
    $t = time();
    $hash = urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, "prombi", true));
    return ($hash . '|' . $seed . '|' . $t);
}

function validateToken($token) {
    $parts = explode('|', $token);
    if(count($parts) === 3) {
        $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], "prombi", true);
        if(hash_equals($hash, urlSafeDecode($parts[0]))) {
            return true;
        }
    }
    return false;
}

function urlSafeEncode($m) {
    return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
}
function urlSafeDecode($m) {
    return base64_decode(strtr($m, '-_', '+/'));
}
?>