/root/swaks --auth \
	--server smtp.mailgun.org:587 \
	--au postmaster@mg.rjimizzou.info \
	--ap 906bd5667341bfa3c02a12560ec851e0-7bce17e5-1ecaa3c6 \
	--from noreply@rjimizzou.info \
	--to $1 \
	--h-Subject: 'Photos Scored' \
	--body 'Your photos have been analyzed! Visit this link to download the scored submission: https://rjimizzou.info/download/'$2'/'$3
	