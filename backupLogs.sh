#!/bin/bash
SOURCE=$HOME/TrabajoSGSSI/logs
BACKUPDIR=ipMaquinaRemota:$HOME/logBackup
DEST="$BACKUPDIR/$(date +%d-%m-%Y)"
AYER="$BACKUPDIR/$(date -d yesterday +%d-%m-%Y)/"
if [ -d "$AYER" ]
then
	OPTS="--link-dest $AYER"
fi

rsync -av $OPTS "$SOURCE" "$DEST"
