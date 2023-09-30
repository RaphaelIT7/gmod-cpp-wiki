<function name="FireEventServerOnly" parent="IGameEventManager" type="classfunc">
	<description>fires a side server event, that it wont be broadcasted to player clients</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L179</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="event" type="KeyValues*">The event to fire</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the event was fired successfully</ret>
	</rets>
</function>