#!/bin/bash  

cd /home/ubuntu/model/RJI-group1-model/ && source contrib/tf_serving/venv_tfs_nima/bin/activate && python -m contrib.tf_serving.tfs_sample_client --image-path /home/ubuntu/photos/users/$1 --model-name mobilenet_aesthetic
