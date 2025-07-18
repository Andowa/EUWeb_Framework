![release](https://img.shields.io/github/v/release/EuFrame/framework?include_prereleases&style=social) 
![license](https://img.shields.io/github/license/EuFrame/EU-api?style=social) 
![size](https://img.shields.io/github/languages/code-size/EuFrame/framework?style=social) 
### English | [简体中文](http://frame.eqmemory.cn/baike)
#### Introduction
EuFrame Framework (EU) is based on PHP multi-end development framework, class library perfect, suitable for the development of various types of applications.
#### Schematic diagram
Difference from traditional MVC  
![schematic](http://frame.eqmemory.cn/image/EUyl-en.jpg) 
#### Environment
Support Nginx/Apache/IIS.  
Support PHP5/PHP7/PHP8 and other known upward distribEUions.
#### Security
.EU.config configuration contains sensitive information.   
You must set in the configuration file to prohibit non local access Config file.  
[Server configuration example](http://frame.eqmemory.cn/baike/config.php)
install-dev is the installation directory of visual package on the development side. If visualization is not required, please delete this directory after deploying EU.
#### system architecture
```
┌─── app /*Application*/
├────├─── assets /*Resource*/
├────├─── admin /*Admin example*/
├────├────└───index.php  /*Admin controller*/
├────├─── log /*Log*/
├────├─── modules /*Module*/
├────├────└───EU-frame
├────├────├────├─admin /*Admin model*/
├────├────├────├─cache
├────├────├────├─skin
├────├────├────├────├─admin /*Admin view*/
├────├────├────├────└─front /*Client view*/
├────├────├────├─front /*Client model*/
├────├────├────├────├─error.php
├────├────├────├────└─index.php
├────├─────────└─EuFrame.config
├────├─── plugins /*Plugin*/
├────├─── template /*Template engineering*/
├────├────└───Template name
├────├─────────├─assets
├────├─────────├─move
├────├─────────├─skin /*Module view*/
├────├─────────├───├─EU-frame
├────├─────────├───├────├─admin
├────├─────────├───├────├─cache
├────├─────────├───├────└─front
├────├─────────├───└─Other module view
├────├─────────└─EuFrame.config
├────└─── config.php /*Application configuration*/
├─── lang /*Language package*/
├─── library /*Class library*/
├─── update
├─── vendor /*Composer dependency*/
├─── .EU.config /*Global configuration*/
├─── aEUoload.php /*Bootloader*/
├─── index.php /*Client controller*/
├─── EuFrame /*Command line*/
└─── EUVER.ini /*Version*/
```
#### [Development documentation](http://frame.EuFrame.com/baike)