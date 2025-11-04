# PAPYRUS

A PHP project for building blogs, portfolios and project documentations.

## Why this product is needed?

Currently there are so many documentation tools available to document projects, write articles and publish stories and series. There is a similar project available for PHP named as **BookStack** in github as open source. But it was build on Laravel and has complex code system and offers little less if you want to cstomize it. It has below minor drawbacks the way I say it.

1. It has complex code system, which will make it difficult to modify anything and add additional functionality.
2. It uses traditional WSYWIG editor for storing contents and descriptions. Its not a bad way, but I think having block-based editor is a good way to keep the data flexible.

So, I've decided to create the project purely based on core PHP from scratch, to manage documentations and individual articles.

## Where does the idea comes from?

I've searched for a consistent technology to maintain documentations for the projects, I am working on. I've come across multiple projects developed in javascript and node js. But that didn't satisfied me, since I have a shared server which only supports PHP and MySQL, I can't run node js applications or create any other job servers for PHP in my server. So I've decided to create the project from scratch using the least amount of third-party libraries, so that the developer has most of the things under control.

## What are the highlights of the project?

1. The project is Module based, so all controllers, routes, services, views can be found in the individual folder. So, there is no need to wander across multiple folders to modify the functionality of the single module.
2. Most of the Utilities, Facades used in the project are defined in the Project's own core, so, developer can modify the project as he like.
3. The project is developed for the developers. So, its not a no-code tool or CMS.
4. The project supports the idea of having full control over the application, so only necessary third-party libraries were used.

## What does the product do?

1. It will allow developers to build their own portfolio, blogs and project documentations.

## What are the key user actions?

1. User can write individual articles.
2. User can create books.
	1. User can create pages under book.
	2. User can create chapters under book.
		1. User can create pages under the chapter.

---
#### Note :

This project is still under development and not yet finished. Anyone interested are welcome to join and contribute to the project.