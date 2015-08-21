# Hair Salon Management App!

##### _A small application which allows you to track your stylists, as well as their clients_

#### By _**Dana Sharman**_ , _Version date 21 August 2015_

## Description

This application allows someone, presumably someone with the goal of managing a group of employed hair stylists, the ability to track both your stylists, and the clients they see. This application has the ability to add and remove both clients and stylists, as well as update client/stylist information. These pages also include the ability to completely remove all clients or all stylists from the database with the click of a button! Extremely adaptable architecture, can be applied to any number of different tracking uses quite easily.


## Setup

* Clone repo from github
* run composer install
* run apachectl start within terminal

* run MYSQL server using SQL -uroot and -proot. Be sure to check the port numbers match what your local server are set to, if not you will need to update either the server to match the port number shown in the code (:8889), or adjust the code to match your server

* run php -S localhost:8000 from within the {root}/web folder


## Technologies Used

- Silex
- Twig
- PHPUnit
- PHP
- MAMP
- MySQL


### Legal


Copyright (c) 2015 **_Dana Sharman_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
