/root/swaks --auth \
	--server smtp.mailgun.org:587 \
	--au ##################################################### \
	--ap ######################################################### \
	--from ############################################################ \
	
    --to $1 \
	--h-Subject: 'Photos Scored' \
	--body 'Your photos have been analyzed! Visit this link to download the scored submission: https://rjimizzou.info/download/'$2'/'$3
	