{literal}
<h3>Dynamic routing options</h3>
<h4>Using Placeholders</h4>
<p>Both the file save path and the optional filename prefix can be customized dynamically with several placeholders:
    <ul>
        <li><span>{r}</span>    - Resource ID</li>
        <li><span>{p}</span>    - Resource Parent ID</li>
        <li><span>{ra}</span>   - Resource Alias (IMPORTANT! Alias can not contain spetssivolov prohibited OS)</li>
        <li><span>{pa}</span>   - Resource Parent Alias (IMPORTANT! Alias can not contain spetssivolov prohibited OS)</li>
        <li><span>{t}</span>    - TemplateVar ID</li>
        <li><span>{u}</span>    - User ID</li>
        <li><span>{d}</span>    - Day of month</li>
        <li><span>{m}</span>    - Month</li>
        <li><span>{y}</span>    - Year</li>
        <li><span>{rand}</span> - Random string of 6 characters</li>
        <li><span>{dt}</span>   - Date and time format Y-m-d-H-s</li>
        <li><span>{time}</span> - Time format timestamp</li>
    </ul>
</p>
<h4>Setting Save Path using a snippet</h4>
<p>You can also specify a snippet that returns a path string for advanced routing by using the @SNIPPET prefix</p>
<p>e.g. <code>@SNIPPET myPathingSnippet</code></p>
<h4>Input File MIME types</h4>
<p>MIME types describe the type of file to be uploaded and relate to the file extension.</p>
<p>Multiple upload types can be specified using a comma-separated list.</p>
<p>e.g. <code>image/jpeg, image/png, application/pdf</code></p>
<p>A (mostly) full list can be found <a href="http://webdesign.about.com/od/multimedia/a/mime-types-by-file-extension.htm" target="_blank">here</a>.</p>
{/literal}