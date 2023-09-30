<function name="FireEventClientSide" parent="IGameEventManager2" type="classfunc">
	<description>Fires the given <page>IGameEvent</page> clientside. **Only use it clientside**</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L126</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="IGameEvent*">The event to fire</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was fired successfully</ret>
	</rets>
</function>