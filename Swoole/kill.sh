#!/bin/bash
ps -ef|grep "php server.php"|grep -v grep|cut -c 9-15|xargs kill -9