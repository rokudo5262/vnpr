=== WordPress User Document ===
Contributors: ZuFusion
Tags: user document, manage documents, search documents, upload document, download file, secure files, download document, approve document, like system, user roles, email notification, responsive table, statistics widget
Requires at least: 4.9
Tested up to: 5.6.2
Stable tag: 5.6.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

WordPress User Document plugin includes many features that help users manage their documents easily. The admin can create / edit / delete / approve / reject documents at backend
In addition, published documents can be viewed directly online without using any additonal reading plugin.
Additionally, statistic widget helps promote the site by highlighting total views, total likes, and total documents


== Main features: ==

* Upload and manage documents with No Limits!
* View documents using Google Viewer via your site
* Allow users to manage their documents and share permission
* Allow Administrators to manage documents
* Allow Administrators to manage licenses
* Widgets: Top Viewed Documents, Most Liked Documents, Most Discussed Documents, Statistic, Tag Cloud, Categories, Featured Documents, Document search, Top Downloads
* Many configurations in Admin Control Panel: Roles, Settings, etc
* Searching and Sorting Option
* Email notification
* Administrators can add documents to users
* Secure documents under login for each user
* Limit file types to be uploaded
* Limit maximum file size
* Unlimited documents for users
* Email editor to customize all emails
* WordPress capabilities and roles integration to limit who can do what
* Secure files for download
* Support BuddyPress group
* Require login to download files with visibility role
* IP block option to prevent downloads from unwanted IP addresses
* Email as attachment to attach the document into their personal emails.
* The Administrators can create / edit / delete / approve / reject documents
* Allow automatically approve the document created by role
* Like/UnLike document system
* Document view/download/like counter
* Document version control
* Custom templates.
* Template type: plugin or theme
* Widget support
* Sidebar left or right
* Responsive layout
* Cross Browser (IE11+, Chrome, Safari, Firefox, Opera, Edge, CentBrowser)
* Translation Ready
* Documentation included

== Frontend ==

+ Document Home Page.

  - All Documents: list out all documents created by all users
  - My Account:
     All documents : list out all documents created by an user.
     Pending : list out all documents that required admin’s approval of an user
     Approved : list out all documents that approved by admin of an user

  - Document search widget: search documents in the site
  - Tag Cloud widget: displays all the available Document’ tags in the site
  - Categories widget: displays all the available Document’ categories in the site
  - Statistics widget:
     Report the numbers of total documents created in the site
     Report the numbers of total views in Document’s modules
     Report the numbers of total likes in Document’s module
  - Advanced widget: Featured Documents, Top Viewed Documents, Most Discussed Documents, Most Liked Documents, Top Download Documents
+ Create a document
  - Document Title: Document Title
  - Document Content: give some general information about the document
  - Document Excerpt: give some excerpt about the document
  - Document Image: add feature image for the document
  - Category: select a category and sub-category (if any) to classify the document
  - tags: add some tags to the document
  - License: choose a license for the document
  - Document file: browse the document from computer
  - File types support: list out the file types support to upload
  - Max File Size: the maximum file size to be uploaded
  - Configure Privacy:
    + Allow Download: allow other users to download the document
    + Email Attachment: allow other users to attach the document into their personal emails.
    + Configure who can see the document
    + Configure who can edit the document
    + Configure who can comment on the document
  - License associated: choose the available license associated
  - Anti-Spam Question
  - Terms and agreement confirm

+ View a created document.
  - Support Google Viewer to preview the document
  - Download Document if available
  - Email as Attachment
  - User is able to Like/Comment/Share via Facebook, Twitter, LinkedIn, Google +, Email

== BackEnd ==

- Allow user to edit their own documents
- Allow user to delete their own documents
- Able to approve/reject documents
- Set the maximum file size of document uploaded
- Set the file type of document uploaded
- Set extensions to preview when using Google Viewer
- Allow automatically approve the document created by roles
- Allow to add comments on documents
- Allow create/delete/feature/view documents
- Allow edit/delete own documents
- Allow download document
- Allow automatically approve the document created by role
- Set Terms and agreement URL
- Configuration roles.
- Manage Documents.
    Feature / Un-feature documents
    Approve / Un-approve documents
    Allow download / lock download
- Manage Categories
    Create/ View / Edit / Delete categories
- Manage tags
    Create/ View / Edit / Delete tags
- Manage Licenses.
    Create/ View / Edit / Delete licenses
- Email notification

== Change log ==

= 1.0 =
* First release
= 1.1.0 =
* Work with WordPress 4.9 +
* Fixed path to load the plugin's current locale
= 1.1.1 =
* Added resize or crop image option
* Allow logged in  or non-logged in can download the documents
* Support BuddyPress group
* Allow other users can edit the document
* Fixed preview document if visibility is Anyone
* Added edit by option with site role or BuddyPress group
* Changed comment by option with site role or BuddyPress group
* Changed visibility by option with site role or BuddyPress group
* Added delete a document when editing document
= 1.1.2 =
* Delete image when deleting document
* Fixed delete when editing document
* Fixed bug when creating document from backend
= 1.1.3 =
* Fixed view document counter
* Fixed js error in document form
* Added share via Facebook, Twitter, LinkedIn, Google +, Email
= 1.1.4 =
* Display list documents with [wud_documents] shortcode
* Added sidebar position right or left
* Fixed sidebar does not work on some themes
* Added show/hide document header option
= 1.1.6 =
* Fixed small bug not show pending documents when un-approved documents at backend
* Flush rewrite query cache when changing query vars
* Fixed some style css
= 1.1.7 =
* Fixed rewrite url settings
= 1.1.8 =
* Fixed the url when re-install the plugin
* Fixed hide toolbar filter when there are no documents
* Added load bootstrap grid option
* Added preview with PDF.js (Google viewer sometime not work)
* Add template type: plugin or theme
* Updated demo site
= 1.1.9 =
* Added table for list documents
* Enable/Disable approved notification
* Enable/Disable reject notification
= 1.2.0 =
* Fixed PDF.js viewer
= 1.2.1 =
* Fixed order by documents on home page