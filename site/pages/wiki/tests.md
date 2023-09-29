# < ambig >
<ambig page="Bug">You might be looking for the "Bug" function, which has the same name as this function on the case-insensitive wiki.</ambig>

# < bug >
<bug issue="1">This tag doesn't support "issue" and "fixed" option</bug>

# < cat >
<cat>tags</cat>

# < deprecated >
<deprecated>You can use this description to link to what they should be using instead</deprecated>

# < internal >
<internal>Please use <page text="this">deprecated</page> function instead</internal>

# < key >
Hold <key>C</key> to open the context menu.

# < note >
<note>Hi1</note>

# < removed >
<removed>Hi2</removed>

# < validate >
<validate>Does this function exist?</validate>

# < structure >
<structure>
	<description>
Right Menu structure
	</description>
	<fields>
<item name="Page Links" type="label">Category of pages actions</item>
<item name="View Page" type="button">View opened page (default)</item>
<item name="Edit Page" type="button">Edit opened page</item>
<item name="View History" type="button">View the history of changes for opened pages</item>
<item name="Username" type="label" default="You">Your username (visible if logged in)</item>
<item name="View Profile" type="button">View your profile page</item>
<item name="Your Changes" type="button">View the list of your changes</item>
<item name="Log Out" type="button">Logs out from your account</item>
<item name="Special Pages" type="label">Category of wiki actions</item>
<item name="Recent Changes" type="button">View the list of recent changes made in the wiki</item>
<item name="Errored Pages" type="button">View the list of pages with parsing errors</item>
<item name="Wikis" type="label">Category of Facepunch wikis</item>
<item name="Garry's Mod" type="button">Garry's Mod Wiki</item>
<item name="Rust" type="button">Rust Wiki</item>
<item name="Steamworks" type="button">Steamworks C# Wrapper Wiki</item>
<item name="Wiki Help" type="button">This wiki</item>
<item name="Internal" type="button">Internal wiki for the staff</item>
<item name="?" type="button">Render stats</item>
	</fields>

</structure>

| Name | Effects |
|-------|------|
| [text](https://wiki.facepunch.com/gmod/GM:DoPlayerDeath?format=text) | Returns only the markup of the page in plain text |
| [html](https://wiki.facepunch.com/gmod/GM:DoPlayerDeath?format=html) | (not 100% Supported!) Returns only the html of the page without any of the surrounding site content |
| [json](https://wiki.facepunch.com/gmod/GM:DoPlayerDeath?format=json) | (Currently not Supported!) Returns a json summary of the content of the page, including the markup and parsed html |