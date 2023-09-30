<function name="FireEventServerOnly" parent="IGameEventManager" type="classfunc">
	<description>fires an event only on this local client. can be used to fake events coming over the network</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L183</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="KeyValues*">The event to fire</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was fired successfully</ret>
	</rets>
</function>