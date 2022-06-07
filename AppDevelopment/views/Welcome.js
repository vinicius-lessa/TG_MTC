/**
 * File DOC
 * 
 * @Description Página de Acesso do App.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da Documentação de Cabeçalho. Mudança na Utilização do componente Navigator.
 *  - Vinícius Lessa - 24/05/2022: Novos ajustes na estrutura e Estilo.
 *  - Vinícius Lessa - 35/05/2022: Finalização do processo de naveção após SignIn/SignOut (CustomActions.reset).
 *  - Vinícius Lessa - 06/06/2022: Melhora visual e de Mensagem ao Usuário
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


export default function Welcome( {route, navigation} ) // Could recieve "props" instead of "{navigation}"
{
    // console.log(props);

    const { userName } = route.params
  
    return (  
    <SafeAreaView style={css.container}>
        <StatusBar/>

        {/* Logo */}
        <View style={ [css.flexOne] }>
            <Animatable.Image
                animation="flipInY"
                source={require('../assets/img/logo.png')}                
                resizeMode = "contain"
                style={ [
                    css.imgDefault ,
                    { top: 40 }
                ] }
            />            
        </View>
        
        {/* Welcome Message */}
        <View style={ [
            css.flexOne, 
            css.centerVerticaly,
        ] }>
            <Animatable.View delay={600} animation="fadeInUp">
                
                <Text style = {[
                    css.textWhite ,
                    css.fontBebas ,
                    css.size30 ,
                    css.centerSelf ,
                    css.m_FourBottom
                ]}>
                    Bem vindo(a), {userName}!
                </Text>

                <TouchableOpacity
                    style={ [
                        css.buttonWelcome, 
                        css.centerChildren, 
                        css.centerSelf
                    ] }
                    onPress={() => {
                        return navigation.dispatch(
                            CommonActions.reset({
                                index: 0, // Home
                                routes: [
                                    { name: 'TradePosts' },
                                ],
                            })
                        )
                    }}
                >                    
                    <Text style={ [
                        css.size26 ,
                        css.textWhite ,                        
                        css.fontBebas ,
                    ] }>
                        Começar!
                    </Text>
                </TouchableOpacity>
            </Animatable.View>
        </View>
        
    </SafeAreaView>
    );
}