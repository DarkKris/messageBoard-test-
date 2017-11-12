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
>  
> **Message:**  
> Display  
> Post  
> Delete  
>  
> **Admin:**  
> Delete others message

***

## Schedule

#### complete:

```php
app\index
	|->model
	|	|->Users.php
	|	|->Message.php
	|   |->Setting.php
	|->controller
	|	|->Login.php
	|   |->Messages.php
	|->view
	    |->login
		|   |->Login.html
		|   |->register.html
		|->message
		|   |->messagelst.html
		|->setting
		|   |->setting.html
		|->usercenter
		    |->usercenter.html
``` 

#### continue:

```php
    adding 'change message'
    adding 'find back password'
```