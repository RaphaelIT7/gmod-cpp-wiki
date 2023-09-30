<function name="FireEvent" parent="IGameEventManager2" type="classfunc">
	<description>Fires the given <page>IGameEvent</page></description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L123</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="IGameEvent*">The event to fire</arg>
		<arg name="bDontBroadcast" type="bool" default="false">true to **not** network the event.</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was fired successfully</ret>
	</rets>
</function>