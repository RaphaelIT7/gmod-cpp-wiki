<function name="FindListener" parent="IGameEventManager2" type="classfunc">
	<description>returns whether this listener is listening to the given event</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L113</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="listener" type="IGameEventListener2">The listener to check</arg>
		<arg name="name" type="const char*">The event to check</arg>
	</args>
	<rets>
		<ret name="listening" type="bool">true if the listener listening to the given event</ret>
	</rets>
</function>