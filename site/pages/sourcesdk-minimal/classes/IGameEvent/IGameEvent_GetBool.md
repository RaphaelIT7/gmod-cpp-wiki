<function name="GetBool" parent="IGameEvent" type="classfunc">
	<description>Returns the bool from the given data field.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L76</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="keyName" type="const char*" default="NULL">the data field to get the value from</arg>
		<arg name="defaultValue" type="bool" default="false">the default value to return if the key doesn't exist</arg>
	</args>
	<rets>
		<ret name="value" type="bool">value of the data field or the defaultValue set.</ret>
	</rets>
</function>