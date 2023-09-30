<function name="GetString" parent="IGameEvent" type="classfunc">
	<description>Returns the string(const char*) from the given data field.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L79</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="keyName" type="const char*" default="NULL">the data field to get the value from</arg>
		<arg name="defaultValue" type="const char*" default=" ">the default value to return if the key doesn't exist</arg>
	</args>
	<rets>
		<ret name="value" type="const char*">value of the data field or the defaultValue set.</ret>
	</rets>
</function>