import React from 'react';                                  // JSX Compilation
import { Text, View, Button, Alert } from 'react-native';   // Core Components
import { css } from '../assets/css/css';                    // Style - css

export default function LoginScreen(props)
{
    return (
        <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
          <Text style={css.titleOne}>Login Screen</Text>
          <Text>E-mail: {props.route.params.email}</Text>
          <Text>Senha: {props.route.params.pass}</Text>
        </View>
      );
}