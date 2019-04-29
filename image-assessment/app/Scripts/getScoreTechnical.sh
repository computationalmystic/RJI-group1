#!/bin/bash  

cd /home/ubuntu/RJI-group1-master/model/ && source contrib/tf_serving/venv_tfs_nima/bin/activate && python -m contrib.tf_serving.tfs_sample_client --image-path /var/www/html/image-assessment/storage/app/unscored/$1 --model-name mobilenet_technical