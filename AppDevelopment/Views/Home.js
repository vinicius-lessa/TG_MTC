import React from 'react';                                  // JSX Compilation
import { Text, View, Button } from 'react-native';   // Core Components
import { css } from '../assets/css/css';                    // Style - css

export default function HomeScreen(props) // Could be export default function HomeScreen({navigation})
{
    console.log(props);
    return (
        <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
            <Text style={css.titleOne}>Home Screen</Text>
            <Button 
                title='Login'
                onPress={()=>props.navigation.navigate('Login',{ // Could be onPress={()=>navigation.navigate('Login',{
                    email: 'vinicius.lessa33@gmail;com',
                    pass: 'ASsjdhDDs768'
                })} 
            />
        </View>
      );
}