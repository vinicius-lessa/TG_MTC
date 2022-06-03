/**
 * File DOC
 * 
 * @Description Página de Acesso do App.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da Documentação de Cabeçalho. Mudança na Utilização do componente Navigator.
 *  - Vinícius Lessa - 24/05/2022: Novos ajustes na estrutura e Estilo.
 *  - Vinícius Lessa - 35/05/2022: Finzalização do processo de naveção após SignIn/SignOut (CustomActions.reset).
 * 
 */

import React from 'react';  // JSX Compilation
import { 
    Text, 
    View, 
    Image, 
    TouchableOpacity, 
    SafeAreaView,
    StatusBar
} from 'react-native'; // Core Components

import { CommonActions } from '@react-navigation/native'; // React Navigation

import * as Animatable from 'react-native-animatable'

import { css } from '../assets/css/css.js'; // Style - css
import { State } from 'react-native-gesture-handler';


export default function Welcome(props) // Could recieve "{navigation}" instead of "props"
{
    // console.log(props);
  
    return (  
    <SafeAreaView style={css.container}>
        <StatusBar/>
        <View style={ [css.flexTwo] }>
            <Animatable.Image
                animation="flipInY"
                source={require('../assets/img/logo.png')}                
                resizeMode = "contain"
                style={ css.imgDefault }
            />            
        </View>
        
        <View style={ [css.flexOne, css.centerVerticaly ] }>
            <Animatable.View delay={600} animation="fadeInUp">
                <TouchableOpacity
                    style={ [css.buttonWelcome, css.centerChildren, css.centerSelf] }
                    onPress={() => {
                            return props.navigation.dispatch(
                                CommonActions.reset({
                                    index: 0, // Home
                                    routes: [
                                        { name: 'TradePosts' },
                                    ],
                                })
                            )
                        }
                    }
                >
                    <Text style={ [
                        css.size20, 
                        css.textWhite, 
                        css.fontBold
                    ] }>
                        Começar
                    </Text>
                </TouchableOpacity>
            </Animatable.View>
        </View>
        
    </SafeAreaView>
    );
}