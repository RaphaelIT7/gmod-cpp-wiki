<function name="CreateEvent" parent="IGameEventManager2" type="classfunc">
	<description>
		Creates a <page>IGameEvent</page> from the given event
		<note>
			This will return NULL if the event is unknown or no listener is registered for it.  
			The creation can be forced with the second argument.  

			if an event was created but not fired for some reason, it has to bee freed with <page text="IGameEventManager2::FreeEvent">IGameEventManager2_FreeEvent</page>
		</note>
	</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L120</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="name" type="const char*">The event name</arg>
		<arg name="bForce" type="bool" default="false">true to force the cration of the event even if no listener is active.</arg>
	</args>
	<rets>
		<ret name="event" type="IGameEvent*">the created <page>IGameEvent</page> or NULL</ret>
	</rets>
</function>