Inventory Management System
------------------------
This project contains my source files used to create an inventory management system while working as at the Higher Education Development Unit. The project was built to solve the problem of tracking the company's inventory in an efficient manner. Previously, their inventory and assets were tracked manually using pen and paper. With this project, they were then able to add, view, edit, tabulate and calculate all of their assets by category, total and item. In addition, users can request to borrow items (loaning) via a ticket request, and administrator could track, and approve loaned items with reminders and deadline to return the item.

## Video Demonstration
A video demonstration of how everything looks can be viewed [here](https://drive.google.com/file/d/0B_E7tBZ1zioFV2VuWHRwZVBTZWs/view?usp=sharing&resourcekey=0-cm-MwExQgAntoNjIh6252Q).

## Getting Started
- `git clone` this folder
- Install `Apache XAMPP` using this [link](https://www.apachefriends.org/index.html)
- Open up XAMPP control panel, and start `Apache` and `MySQL` modules
- Click the `Admin` button for MySQL to be directed to PhpMyAdmin, where you can import the `.sql` seen inside the repository.
- Go to `/login`, using username: `techadmin` and password: `Passw0rd` 
- You will also need to config your `php.ini` file to allow mailing functions to work. You can verify that mailserver at "localhost", "SMTP" and "smtp_port" is set to 25 in the `php.ini`. Here's a [guide](https://www.quackit.com/php/tutorial/php_mail_configuration.cfm).


Features:
----------------
- Dashboard
- Login
- Register
- View all inventory
- Search Inventory
- Add inventory
- Create loan requests for persons to borrow inventory
- Ticket requests
- 404 Error
- 500 Error

Technologies:
-----------------
- Boostrap 
- HTML
- CSS
- PHP
- Apache XAMPP
- mysqli

Browser Support:
----------------
- IE 9+
- Firefox 5+
- Chrome 14+
- Safari 5+
- Opera 11+

Change log:
-----------
ver 1.2:
- Fixed the sidebar scroll issue when using the fixed layout.
- Added [Bootstrap Social Buttons](http://lipis.github.io/bootstrap-social/ "Bootstrap Social") plugin.
- Fixed RequireJS bug. Thanks to [StaticSphere](https://github.com/StaticSphere "github user"). 

ver 1.1:
- Added new skin. class: .skin-black
- Added [pace](http://github.hubspot.com/pace/docs/welcome/ "pace") plugin.

To Do List:
-----------
- More features
- Ajax version
- More skins
- Documentation

