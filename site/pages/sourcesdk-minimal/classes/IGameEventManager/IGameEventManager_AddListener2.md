<ambig page="IGameEventManager_AddListener">You might be looking for the "IGameEventManager::AddListener" function, which listens for a particular event instead of all events.</ambig>
<function name="AddListener" parent="IGameEventManager" type="classfunc">
	<description>adds a listener for all events.</description>
	<source>https://github.com/danielga/sourcesdk-minimal/blob/master/public/igameevents.h#L167</source>
	<realm>Shared and Menu</realm>
	<args>
		<arg name="listener" type="IGameEventListener">The listener to add</arg>
		<arg name="bServerSide" type="bool">wheather the listener is serverside</arg>
	</args>
	<rets>
		<ret name="success" type="bool">true if the listener was added successfully</ret>
	</rets>
</function>