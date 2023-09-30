<function name="UnserializeKeyValue" parent="IGameEventManager" type="classfunc">
	<description>Reads all keys from the given <page>bf_read</page>.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L187</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="buf" type="bf_read*">The buffer to read the event from</arg>
	</args>
	<rets>
		<ret name="event" type="KeyValues*">the event read from the bitbuffer</ret>
	</rets>
</function>