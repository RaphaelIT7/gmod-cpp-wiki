<function name="SerializeEvent" parent="IGameEventManager2" type="classfunc">
	<description>Writes the given event into the given <page>bf_write</page>.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L132</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="IGameEvent*">The event to write</arg>
		<arg name="buf" type="bf_write*">The buffer to write the event to</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was successfully written into the bitbuffer</ret>
	</rets>
</function>