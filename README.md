# CS-4320-Project

sudo docker run -d -p 8500:8500 tfs_nima

Job: RJI Photographer

Technical Background: Little to None

Name: Photographer

 

For this refined requirements case, we are going to assume a situation that is least beneficial to us – that the described user has little technical background, and will not be able to easily navigate unclear sections of the program.

 

We consider a photographer employed by the Reynolds Journalism Institute – or potentially any institute utilizing the project – who has taken a number of photographs and wishes to submit them for review. Assuming the person knows the URL, they will be greeted by a modern website, with a variety of information. A description of the project, its purpose, some sample images, and contact information for the institution and the project maintainers should be presented on this webpage, with a number of link provided for different sections of the website, including further instructions and the ability to sign up for an account. One of these links will have, in large, visible text, ‘Existing Users – Log In.’ The user will navigate to the log in page, input their credentials, and be taken to a library of their previously submitted work. Their images will be sorted by upload time – photographs uploaded in the same batch will be presented with each other – and will show the associated scores of the images; hovering over the images will provide additional information, such as name, date, and other metadata. The interface will be clean and obvious, with no nested menus or unclear operations. Simple to understand commands will be provided, such as the ability to delete images, upload images for assessment, or search for particular images. Once the user has completed the operations they would like to conclude, they will be able to log out or simply close the web page.

 

In order to reach a phase in our project where we can potentially have a user accomplish these tasks in this order, we have - through github - identified a number of features that need to be implemented and issues that need to be resolved. For features, we will be implementing a user account system, as well as notifications for when a user's images have been assessed, and the ability for users to provide feedback on images that have been graded. On the backend, we will be moving storage of the images to the cloud and implement a compression method of some kind to ease up hard drive usage; considering the size of the images being assessed, storage is a priority. Finally, to improve upload speeds - the current assessment performance bottleneck - we will be implementing our upload system with Dropzone.js. With these improvements, and some additions to our website, we believe we will be much closer to a presentable project.
