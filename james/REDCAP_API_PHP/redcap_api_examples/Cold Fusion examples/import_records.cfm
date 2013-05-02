<!--- Set secret token specific to your REDCap project --->
<cfset variables.token = "YOUR_TOKEN" />

<!--- Set the url to the api (ex. https://YOUR_REDCAP_INSTALLATION/api/) --->
<cfset variables.apiUrl = "YOUR_API_URL" />

<!--- Read the contents of a file containing the records you want to import into a variable --->
<cffile action="read" file="FULL_PATH_TO_FILE" variable="records">

<!--- API request to import data from file --->
<cfhttp url="#variables.apiUrl#" method="POST" result="httpImport">
	<cfhttpparam name="content" type="formfield" value="record">
	<cfhttpparam name="type" type="formfield" value="flat">
	<cfhttpparam name="format" type="formfield" value="xml">
	<cfhttpparam name="token" type="formfield" value="#variables.token#">
	<cfhttpparam name="overwriteBehavior" type="formfield" value="normal">
	<cfhttpparam name="data" type="formfield" value="#records#">
	<cfhttpparam name="returnContent" type="formfield" value="count">
</cfhttp>

<!--- Display the results of the import attempt --->
<cfif httpImport.statusCode EQ "200 OK">
	<h2>Success!</h2>
	<!--- Show the number of successfully imported records --->
	<p>#httpImport.FileContent# records imported</p>
<cfelse>
	<h4>Error code: #httpImport.statusCode#</h4>
	<p>#httpImport.FileContent#</p>
</cfif>
