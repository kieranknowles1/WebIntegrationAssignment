# Todo List

## Part 1 : Web API
For part 1 you will use object-oriented PHP to implement a web API.

### Essential requirements for part 1
(pass / fail)

Your work for part 1 must meet the following essential requirements. These essential requirements are
pass/fail and do not have marks directly associated with them. These requirements are taken into
consideration in the grade descriptors for the quality requirements and for tasks 1.1 and 1.2. If you fail
to meet any of these essential requirements your marks for part 1 are unlikely to exceed 40% and may
be zero.

- [x] The web API must be deployed on the nuwebspace web server.
- [ ] The web API must be implemented using object-oriented PHP and must not use a third-party
      framework or library except the JWT library specified for task 1. 2.
- [ ] The coursework must use the _chi2023.sqlite_ database provided and must not modify this. The
      _users.sqlite_ database should also be used and can be modified.
- [ ] Your work must include a readme file giving the full URL for every endpoint implemented and
      clearly listing what parameters are supported and how to use them (see appendix 1).

### Quality requirements for part 1
(10 marks)

The following are quality requirements that your code for tasks 1 .1 and 1. 2 should meet. You will be
graded for how well you meet these requirements.

- [ ] You must use Object-Oriented PHP code that is well structured and easy to read. No specific
      design patterns or system architecture is required but your work should be well organised.
- [ ] No files, classes, or sections of code should be included in your submission unless they have a
      purpose for your Web API. No code should be commented out.
- [ ] You must use an appropriate coding style following the recommendations in PHP FIG PSR- 1
      and PSR- 12 as well as the guidance on the module.
- [ ] You must follow the PHP-FIG PSR- 5 PHPDoc draft standard when commenting code. Tags
      from section 5 of PSR-19 should also be used in the comments where appropriate. You should
      include the @author tag followed by your name in every script you have written or modified. If
      you have used AI tools you must state this with use of the @generated tag followed by a short
      explanation. You do not need to produce any documentation for your code, just include
      comments using the ‘doc comments’ format.
- [x] Your code must make use of an autoloader.
- [ ] Your code must make use of an exception handler.
- [x] The web API must use clean URLs. No API endpoint should require use of a .php or other file
      extension within the URL.
- [x] An .htaccess file must be used to enforce the single point of entry pattern covered in the module.
  - [x] All requests must be handled by a single ‘front door’ script (typically called index.php
          or api.php).
  - [x] It should not be possible to directly access any other files or folders via HTTP requests.

### Task 1.
(20 marks)

For task 1.1 you will create a Web API with (at least) five endpoints. A list of general requirements
for each endpoint is given below:

- [ ] All responses from the API must contain relevant headers, including a relevant HTTP status
      code.
- [x] Set the Access-Control-Allow-Origin header
- [ ] Set the Access-Control-Allow-Methods header
- [x] All responses from the API that contain data must return this in valid JSON format.
- [x] All endpoints created for this task must support the request method GET.
- [ ] Error handling with a relevant HTTP status code and, where appropriate, an error message in JSON format.
  - [x] Requests to invalid endpoints - return 404,
  - [x] use of invalid parameters,
  - [ ] invalid combinations of parameters,
  - [x] invalid values,
  - [x] server errors (e.g. database errors) - return 500
  - [ ] any other error should be responded to
- [x] Endpoints and parameter names and values should not be case sensitive.
  - [x] Endpoints should be case insensitive.
  - [x] Parameter names should be case insensitive.
  - [x] Parameter values should be case insensitive.
- [ ] Additional endpoints can be created if you wish. Additional parameters can be supported if you
      wish. The endpoints listed below can also return more data than is specified if you wish. Any
      additional endpoints, parameters and data must be appropriate to the purposes of the API.
- [x] All endpoints except endpoint 1 must retrieve data from the _chi2023.sqlite_ database.
- [x] The name of the endpoint is what should appear in the URL path, for example the endpoint
      'developer' might have the URL https://nuwebspace.co.uk/kf6012/coursework/api/developer
- [ ] The full URL for each endpoint should be given in the readme file. For each parameter
      supported there should also be a clear example (see appendix 1).
- [x] An endpoint should work whether or not there is a trailing slash at the end of the URL.

#### Endpoints

- [x] developer
  - [x] Return name and student ID
- [x] country
  - [x] Return country names in the affiliation table
  - [x] Distinct elements only
- [x] preview
  - [x] Return links to preview videos along with their content title
  - [x] Do not return content with no preview
  - [x] Return items in a random order
  - [x] Limit parameter
- [x] author-and-affiliation
  - [x] Return the country, city, and institution each author is affiliated with for each publication they are
        associated with
  - [x] Handle authors having multiple affiliations for each item of content
  - [x] Handle authors having different affiliation on different items of content
  - [x] Content ID parameter, mutually exclusive with country
  - [x] Country name parameter, mutually exclusive with content
  - [x] Return the author ID, author name, content ID, and content name for each affiliation
- [x] content
  - [x] Return information about all research content
  - [x] return the title, abstract, and content type
  - [x] Page parameter, if specified, return a page of 20 items after type filtering
  - [x] Type name parameter, if specified, return only content with matching type

### Task 1. 2
(20 marks)

For task 1.2 you must add (at least) two further endpoints to your Web API. You will also need to
make a new database table. A list of general requirements for each endpoint is given below:

- [ ] All general requirements for task 1.1 must be met except regarding the request methods.
- [ ] The endpoints for this task should support appropriate request methods, not limited to GET
- [ ] A full URL for both endpoints must be given in the readme file and the parameters clearly
      explained (see appendix 1).
- [ ] When generating a JWT a unique secure key consisting of random characters must be used
- [ ] An external library 'firebase/php-jwt' introduced on the module can be used for this task
- [ ] _The user.sqlite_ database should be used. This database can be modified in any way you wish but
      the two example users provided in the accounts table must be able to log in using their
      credentials (see appendix 2).

#### Endpoints
See [KF6012 Assessment Brief](KF6012%20-%20CIS%20Assessment%202023-24.pdf) for endpoint details

- [ ] token
  - [ ] Accept a username and password in the headers
  - [ ] If username and password are valid, create return a JWT token
  - [ ] Tokens must contain user ID
  - [ ] Tokens must not contain private data (e.g., password)
  - [ ] Token should not transfer data needed by the client
  - [ ] Token should be valid for 30 minutes
- [ ] note
  - [ ] GET
    - [ ] Get all notes for a user
    - [ ] Users must be authenticated with a valid JWT token
    - [ ] Return the note ID, content ID, and note text
    - [ ] Only return notes for the user specified in the token
  - [ ] POST
    - [ ] Create a new note
    - [ ] Take the content ID and the note text as parameters
    - [ ] Users must be authenticated with a valid JWT token
    - [ ] Return the new note ID
  - [ ] PUT
    - [ ] Update an existing note
    - [ ] Take the note ID and the note text as parameters
    - [ ] Users must be authenticated with a valid JWT token
  - [ ] DELETE
    - [ ] Delete an existing note
    - [ ] Take the note ID as a parameter
    - [ ] Users must be authenticated with a valid JWT token

# Part 2 : Web application

For part 2 you will use React to create a web application that interacts with the web API produced in
part 1.

## Essential requirements for part 2
(pass / fail)

Your work for part 2 must meet the following essential requirements. These essential requirements are
pass/fail and do not have marks directly associated with them. These requirements are taken into
consideration in the grade descriptors for the quality requirements and for tasks 2.1 and 2.2. If you fail
to meet any of these essential requirements your marks for part 2 will be unlikely to exceed 40% and
may be zero.


- [ ] The application must be deployed on the nuwebspace web server.
- [ ] The application must be implemented using React. It must be a ‘front-end’ application and not
      use server-side React components. You can use any appropriate build tools and third-party
      components you wish. You should use JavaScript (not TypeScript).
- [x] The application must interact with your Web API created for part 1.
- [ ] You must submit the source code on Blackboard, not just the build files used for deploying the
      app.
- [ ] You must not copy text, images, logos or colour schemes from the original CHI 2023
      conference website or any related sources.
- [ ] There must be a readme file giving the full URL for the main landing page of your web
      application (see appendix 1)

## Quality requirements for part 2
(10 marks)

The following are quality requirements that your work for tasks 2.1 and 2.2 should meet. These
requirements concern the code as well as the user interface.

- [ ] You must use React code that is well structured and easy to read. No specific design patterns or
      system architecture is required but your work should be well organised into components, files and folders.
- [ ] No files, folders, components, or sections of code should be included in your submission unless
      they have a purpose for your application. No code should be commented out and messages
      should not be logged to the console (unless meaningful to do so in a public-facing system).
- [ ] The React code should follow the style recommendations covered on the module.
- [ ] All components should contain comments using the Doc Comment style explained on the
      module. You should include the @author tag followed by your name in every component you
      have written or modified. If you have used AI tools you must state this using the @generated
      tag followed by a short explanation. You do not need to produce any documentation for your
      code, just use the ‘doc comments’ format.
- [ ] The application must be styled using Tailwind
- [ ] The application must have a high-quality design, including an appropriate colour scheme,
      appropriate and consistent page structure, appropriately presented interface elements and
      consistent and easy-to-follow navigation. The interface should be fluid or responsive so that it
      can be viewed on a variety of screen widths.
- [ ] The design should not incorporate any 'unfinished' elements or placeholders such as lorem-
      ipsum text, blank pages, inactive components, deliberate errors or invalid links.

## Task 2.1
(20 marks)

For task 2.1 you should create a web application with at least 3 pages. A list of general requirements
for these pages is given below.

- [x] A router must be used and each page specified below should represent a distinct route in the
      application.
- [x] In addition to the specified pages there must be a ‘404 not found’ page that is displayed when
      an invalid route name is used.
- [x] All pages should have a footer containing your name, student id and the text “Coursework
      assignment for KF6012 Web Application Integration, Northumbria University”.
- [x] At least one page should contain an image. This should not be a CSS ‘background image’ but
      displayed using React. This could be on any page including the ‘ 404 not found’ page.
- [ ] Navigating between routes should not trigger unnecessary new fetch requests if that data has
      previously been fetched.
- [ ] If there is no data to display there should be an appropriate message or visual representation.
- [ ] Additional pages to those specified can be included if they would be meaningful in a real-world,
      public-facing application.


The three pages you must implement are specified below:

- [x] Home
  - This is the main landing page of your application. It should include:
  - [x] Heading “CHI 2023”
  - [x] Menu with links to other pages
  - [x] Title and link to a random preview video
  - More data or features can be included on this page if you wish.

- [x] Countries
  - [x] This page should list each country represented in the affiliation table in the
        database (giving the name once). This information can be presented as a list or in
        some other way.
  - [x] There should be a search feature on the page to allow the user to search for the
        name of a country.
  - [x] More features and functionality can be included if you wish, for example when
        clicking on a country name further relevant information might be shown.

- [ ] Content
  - [ ] This page should show details of each item of research content including the
    - [x] title,
    - [x] abstract
    - [ ] authors’ names
    - [ ] the authors’ affiliations
    - [x] the content type
    - [ ] whether it has won an award.
  - [x] The page should show blocks of 20 items of content
        at a time, with the ability to navigate to further or previous blocks of content.

  - [ ] There should also be a 'select' component giving options to view "All content" or
        specific types of content such as "Papers", "Posters" etc. If a specific type of
        content is selected then that data must still be presented in blocks of 20.

## Task 2.2
(20 marks)

For task 2.2 you will create two or more new features for the web application that enable users to
authenticate (sign in and out) and to retrieve, add and delete short notes about items of content. For
both features the following requirements should be met:

- [ ] The features listed below can be presented as pages within the application or as components
      within existing pages. The features should be consistent with the overall design of the app.
- [ ] A signed in user should remain signed in when navigating within the application.
- [ ] Information should be stored using a cookie or local-storage so that if the user closes the
      browser they are still signed in when they revisit the application.
- [ ] When a user signs out, the application should not retain data about that user.
- [ ] Confidential data about a user must not be logged in the console.
- [ ] Additional related features and functionality can be included if these would be meaningful in a
      real-world, public-facing application.

The following features should be implemented:

- [ ] Sign in/out
  - [ ] It must be possible to sign into the application. Authorisation should be handled by
        the backend Web API.
  - [ ] Once a user is authenticated they should have the ability to
        sign out.
  - [ ] The JWT returned by the Web API should be stored in an appropriate way
        by the browser.
  - [ ] If a user is signed in but their request is rejected by the Web API
        (e.g. if they have an expired token) they should be prompted to sign in again.
  - [ ] When a user signs out the token should no longer be stored by the browser.
  - [ ] Relevant error messages should be displayed when there are unsuccessful attempts to sign in.

- [ ] Notes
  - [ ] Signed in users must be able to add notes about items of content.
  - [ ] The user should be able to type a short note (limiting the note to around 250 characters is acceptable
        if you wish) regarding an individual item of content.
  - [ ] This note should be saved by the API.
  - [ ] Logged in users should be able to see notes they have previously created.
    - [ ] Should be able to edit existing notes.
    - [ ] Should be able to delete notes.
  - [ ] Users should only be able to see, edit or delete their own notes, not those made by other people.
