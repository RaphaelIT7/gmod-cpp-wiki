<ambig page="IGameEventManager_AddListener2">You might be looking for the "IGameEventManager::AddListener" function, which listens for all events instead of a particular event.</ambig>
<function name="AddListener" parent="IGameEventManager" type="classfunc">
	<description>adds a listener for a particular event.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L165</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="listener" type="IGameEventListener">The listener to add</arg>
		<arg name="name" type="const char*">The event we want to listen for</arg>
		<arg name="bServerSide" type="bool">wheather the listener is serverside</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the listener was added successfully</ret>
	</rets>
</function>