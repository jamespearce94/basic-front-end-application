# Basic Front End application

## Introduction:
This application has been set up using a basic PHP application
to serve as a back end. You can run this application from the
cli by entering `./composer.phar serve` (Note: You will need
to have PHP installed on your system). This will serve the
application from http://localhost:8080.

This application provides two access modes:
1. Browser based requests from `http://localhost:8080/`.
2. API requests from `http://localhost:8080/api`.

### 1: Web requests
This endpoint renders a page to the browser using the Twig
templating language. The page contains a form which can be
submitted and will return an application response. View
templates are located in the source directory `/templates`.

### 2: REST API
All API endpoints are GET requests and as such will take
query params as arguments.

## Tasks:

- Using the Twig templating language, add a header and a footer
  to the template being rendered at the web endpoint.
- Currently the 'language' input is freeform, but only a limited
  number of options are available. Change this to give the user
  only the options available for a valid request.
- Visiting http://localhost:8080/single-page will serve a
  placeholder for a "single page application". Replicate the
  functionality of the normal form using front-end technologies.
  
## Considerations

- Fork this repository and commit your work to your own repo.
- Best practice for git commits should be used: please don't commit all
  your work in a single commit.
- If you have any questions about this exercise, please feel free to
  get in touch with me at any time.
