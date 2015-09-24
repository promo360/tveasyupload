--------------------
Extra: FastUploadTV
--------------------
Version: {$version}
Build:   {$date}
Commit:  {$commit}

Author: Alan Pich <alan.pich@gmail.com>, Evgeniy Yudin (JINN) <promo360@yandex.ru>
License: GNU GPLv2

This project is hosted on github:
https://github.com/promo360/fastuploadtv

The Fast Upload TV input provides the simplest possible file upload experience for the end user,
offering single-button file selection & uploading without the use of the MODx file manager. File save paths are
set on the TV itself, so the content-editor doesn't have to worry about where to save to.

It is fork from Alan Pich Simple File Upload TV.

### Installation Instructions
Install this package through the Package Manager or download from the [MODx Extras Repository](http://modx.com/extras/package/fastuploadtv).
Once installed, 'Fast Upload TV' will become an option in the TV Input Type selection list.


### Input Configuration Options
While hiding many of these features from the Resource editor, Fast Upload TVs are very customisable! They
work with any stream-based (filesystem) mediasource, can be saved to a custom path within the source, and optionally
prefix a string to the filename in order to make maintainance and curation of uploaded files easier over time.
You can even restrict file upload types by specifying required MIME types!

#### Placeholders
Both the file `Save Path` and `File Prefix` fields can be customised by editing the corresponding fields in
the TV Input Options tab. Both options can be customized dynamically with several placeholders:
{literal}
* `{id}`     - Resource ID
* `{pid}`    - Resource Parent ID
* `{alias}`  - Resource Alias (IMPORTANT! Alias can not contain spetssivolov prohibited OS)
* `{palias}` - Resource Parent Alias (IMPORTANT! Alias can not contain spetssivolov prohibited OS)
* `{tid}`    - TV ID
* `{uid}`    - User ID
* `{rand}`   - Random string
* `{t}`      - Timestamp
* `{y}`      - Year
* `{m}`      - Month
* `{d}`      - Day
* `{h}`      - Hour
* `{i}`      - Minute
* `{s}`      - Second
{/literal}
#### Advanced Save Path routing using Snippets
You can also specify a snippet that returns a path string for advanced routing by using the @SNIPPET prefix
e.g. `@SNIPPET myPathingSnippet`


#### Restricting file types using MIME
MIME types describe the type of file to be uploaded and relate to the file extension.
Multiple upload types can be specified using a comma-separated list.

e.g. `image/jpeg, image/png, application/pdf`

A (mostly) full list can be found [here](http://webdesign.about.com/od/multimedia/a/mime-types-by-file-extension.htm).


