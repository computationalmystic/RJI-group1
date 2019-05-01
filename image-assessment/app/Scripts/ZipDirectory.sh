#!/bin/bash  

cd assessment/storage/app/users/$1/$2/submission.zip /var/www/html/image-assessment/storage/app/users/$1/

sudo zip -r /var/www/html/image-assessment/storage/app/users/$1/$2/submission.zip /$2/