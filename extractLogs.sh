#!/bin/bash
sudo docker cp $(sudo docker ps -aqf "name=trabajosgssi_web_1"):/var/log/apache2/access.log $HOME/TrabajoSGSSI/logs/access-$(date +"%d-%m-%Y--%H:%M").log
sudo docker cp $(sudo docker ps -aqf "name=trabajosgssi_web_1"):/var/log/apache2/error.log $HOME/TrabajoSGSSI/logs/error-$(date +"%d-%m-%Y--%H:%M").log
