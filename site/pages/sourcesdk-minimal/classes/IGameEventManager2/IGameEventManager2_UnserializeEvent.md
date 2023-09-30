<function name="UnserializeEvent" parent="IGameEventManager2" type="classfunc">
	<description>Reads a <page>IGameEvent</page> from the given <page>bf_read</page>.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L132</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="buf" type="bf_read*">The buffer to read the event from</arg>
	</args>
	<rets>
		<ret name="event" type="IGameEvent*">the event read from the bitbuffer</ret>
	</rets>
</function>