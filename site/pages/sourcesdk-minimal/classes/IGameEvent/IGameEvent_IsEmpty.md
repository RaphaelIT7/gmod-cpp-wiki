<function name="IsEmpty" parent="IGameEvent" type="classfunc">
	<description>Returns whether if data field exists.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L73</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="keyName" type="const char*" default="NULL">the data field to check</arg>
	</args>
	<rets>
		<ret name="exists" type="bool">true if the data field is empty</ret>
	</rets>
</function>