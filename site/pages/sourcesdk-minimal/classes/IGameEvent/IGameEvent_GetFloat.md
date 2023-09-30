<function name="GetFloat" parent="IGameEvent" type="classfunc">
	<description>Returns the float from the given data field.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L78</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="keyName" type="const char*" default="NULL">the data field to get the value from</arg>
		<arg name="defaultValue" type="float" default="0.0f">the default value to return if the key doesn't exist</arg>
	</args>
	<rets>
		<ret name="value" type="float">value of the data field or the defaultValue set.</ret>
	</rets>
</function>