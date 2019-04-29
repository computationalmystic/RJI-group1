/root/swaks --auth \
	--server smtp.mailgun.org:587 \
	--au postmaster@sandbox32a74136f3ea4c50a9726b45d6495be6.mailgun.org \
	--ap e32e047e9b5140dff1ced04ab730fb93-dc5f81da-39bed3e1 \
	--from postmaster@sandbox32a74136f3ea4c50a9726b45d6495be6.mailgun.org \
	--to $1 \
	--h-Subject: 'Photos Scored' \
	--body 'The useID is '$2.' And the submissionID is '$3
