### Create a simple API with laravel 8 

Remember the study of laravel in my profile. I will use some terms and method here. 
Give a look on my project: https://github.com/Gessilt/Lavarel-study. Thanks.

# What is API? 

Aplication Programmimg Interface, a algorithms (set of routines and standards) establiished by a software.

Comes to simplify the development of programs and applications. 

# API web

A set of interfaces in the context of the web development , usually in XML or JSON format. The most used technique is REST.

# REST?

Representational State Transfer, a framework, which define restrictions to web services. The web services that comply are called RESTful.

## RESTful

- Managed by HTTP verbs;
- Stateless communication between client and server. Each request is separate and no information is stored between;
- Data is cached;
- Uniform interface between components so that information is standardized;
  - The user needs to receive the data in a way that he can identify it;
  - The user can manipulate the data recieved;
  - Messages sent to user must to be self-explanatory;
  - The hypermidia must be integrated. To user see what he can do.
- It needs a layer that organizes the servers, with all their functions, involved in retrieving requested information.

To run it, you will need start the laravel by 

```bash
php artisan serve
```

To use the api, put in your URL, localhost:127.0.0.1/api/xxxxx
