<!--- Set secret token specific to your REDCap project --->
<cfset variables.token = "YOUR_TOKEN" />

<!--- Set the url to the api (ex. https://YOUR_REDCAP_INSTALLATION/api/) --->
<cfset variables.apiUrl = "YOUR_API_URL" />

<!--- API request --->
<cfhttp url="#variables.apiUrl#" method="POST" result="apiResult">
	<cfhttpparam name="content" type="formfield" value="record">
	<cfhttpparam name="type" type="formfield" value="flat">
	<cfhttpparam name="format" type="formfield" value="json">
	<cfhttpparam name="token" type="formfield" value="#token#">
</cfhttp>

<!--- The data can be accessed as a CF variable by referencing the 'result' field as defined above --->
<!--- Dump the contents of the result variable --->
<cfdump var="#apiResult#">

<!--- 
Two properties of the result you will be interested in
#apiResult.statusCode# - see HTTP status codes and their meanings on the REDCap API help page
#apiResult.FileContent# - this is your data
--->