## Piotr Zadka 2CWK50: A Social Network Documentation

## Setup
To create database, visit **/create_data.php**. This pages will create the `skeleton` database and corresponding tables. For further access to the database and it's contents, visit **/phpmyadmin**.

## Sign in
To login into the website please visit **/sign_in.php** and use one of the following credentials.

| Username | Password | Admin |
|----------|----------|:-----:|
|admin     |secret    |  YES  |
|barryg    |letmein   |       |
|mandyb    |abc123    |       |
|mathman   |secret95  |       |
|brianm    |test      |       |
|a         |test      |       |
|b         |test      |       |
|c         |test      |       |
|d         |test      |       |

Page back-end will check for matching `username` & `password` and if correct will let user access page contents. 
Client side & server side checks if username and password **is within 1-16 characters long**. Additionaly server-side validates all provided information using `sanitise()` function inside **/helper.php**. User will be informed if any of the provided data is invalid with adequate information.

## Registration
User can create your own account by visiting **/sign_up.php** and providing username and password. Client-side and server-side validates both inputs and checks if provided information **is within 1-16 characters long**. Additionaly server-side validates all provided information using `sanitise()` function inside **/helper.php**. User will be informed if any of the provided data is invalid with adequate information.

## Password Hashing
All `passwords` are **hashed** and checked using PHP's `password_hash()` and `password_verify()` functions that uses bcrypt algorithm.

## Set Profile
User can setup a new profile by visiting **/set_profile.php** if he/she haven't done before. Client-side and server-side validates if provided inputs are valid.  
**First Name** is validated by ensuring that the input contains **only alphabetic letters**, and **is within 1-16 characters**.  
**Last Name** is validated the same way as **First Name**.  
**Number of pets** is validated by ensuring that the input contains **only numeric values**, and **is within range of 0-5**.  
**Email** is validated by ensuring that the provided email address is valid using `FILTER_VALIDATE_EMAIL` filter.  
**Date of birth** is validated by checking if its in correct format **YYYY-MM-DD**.  
Profile information can be updated anytime. 

## View All Profiles
To view all set-up profiles, visit **/browse_profiles.php**. Click on a chosen username to view his/her profile. Only users with **set-up profiles** are visible. Back-end checks which user was clicked and generates new hyper-link that passes URL parameters to **/show_profile.php**.




