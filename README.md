>  **Created by DarkKris on 2017/10/28.**  
>  **Copyright © 2017 DarkKris. All rights reserved.**

# This is a repository for test and its theme is "Create a meassge board".

***

## Function

> **User:**  
> Login/LoginOut(Captcha)  
> User Center  
> Set avatar  
> Set rows of paginating  
> Change password  
> Be Deny to use function  
>  
> **Message:**  
> Display  
> Post  
> Delete  
> Change 
> Comment 
> Like  
>  
> **Admin:** (userId=3;password="admin")  
> Delete others message  
> User controller (include create user)  
> Search user  
>
> **Tourist** (userId=2;no password)  
> login

***

## Schedule

#### complete:

```php
app\index
	|->model
	|	|->Users.php
	|	|->Message.php
	|   |->Setting.php
	|   |->Addlike.php
	|->controller
	|	|->Login.php
	|   |->Messages.php
	|   |->Setting.php
	|->view
	    |->login
		|   |->Login.html
		|   |->register.html
		|->message
		|   |->changecom.html
		|   |->changemsg.html
		|   |->messagelst.html
		|   |->comment.html
		|->setting
		|   |->setting.html
		|->usercenter
		    |->admin.html
		    |->searcher.html
		    |->usercenter.html
``` 

#### continue:

```php
    adding 'find back password by e-mail'
```