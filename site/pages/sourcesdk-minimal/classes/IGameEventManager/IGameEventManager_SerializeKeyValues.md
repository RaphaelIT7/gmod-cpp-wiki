<function name="SerializeKeyValues" parent="IGameEventManager" type="classfunc">
	<description>Writes the given event into the given <page>bf_write</page>.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L186</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="KeyValues*">The <page>KeyValues</page> to write</arg>
		<arg name="buf" type="bf_write*">The buffer to write the event to</arg>
		<arg name="eventtype" type="CGameEvent*" default="NULL">The eventtype?</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was successfully written into the bitbuffer</ret>
	</rets>
</function>