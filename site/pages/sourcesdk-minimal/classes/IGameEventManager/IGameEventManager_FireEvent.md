<function name="FireEvent" parent="IGameEventManager" type="classfunc">
	<description>
fires an global event, specific event data is stored in KeyValues local listeners will receive the event instantly  
a network message will be send to all connected clients to invokethe same event there
	</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L176</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="KeyValues*">The event to fire</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was fired successfully</ret>
	</rets>
</function>