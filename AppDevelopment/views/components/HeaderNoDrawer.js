/**
 * File DOC
 * 
 * @Description Componente de Cabeçalho padronizado que recebe alguns parâmetros, como Título.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/06/2022: Ciração do arquivo para ser usado pela View 'TradePostDetailed'. Criação da estrutura básica, e troca do Icone esquerdo.
 * 
 */

 import React from 'react';  // JSX Compilation
 import {
   Text,
   View,
   SafeAreaView,
   TouchableOpacity ,   
   StatusBar
 } from 'react-native'; // Core Components
   
import { css } from '../../assets/css/css.js'; // Style - css

import * as Animatable from 'react-native-animatable'; // Animation

import { AntDesign } from '@expo/vector-icons'; // Icons

import { useDrawerStatus } from '@react-navigation/drawer'; // Navigation
 

const HeaderNoDrawer = (props) => {

    const pageTitle      = props.title;   
    const userName       = props.userName;      
    const userPhotoURL   = props.userPhotoURL; 

    // Booleans
    const isLoggedUser   = !!props.userName;

    return (
        <SafeAreaView>
            <StatusBar/>
            <View style = { [ css.headerDefault ] }>

                {/* Arrow Left */}
                <View style = { [ 
                    css.centerVerticaly, 
                    css.p_ThreeX,                    
                ] }>
                    <View style = { [ { alignSelf: 'flex-start' } ] }>
                        <TouchableOpacity                                                        
                            onPress={() => props.navigation.goBack()}
                        >                            
                            <AntDesign name="arrowleft" size={28} color="#eb1f36" />
                        </TouchableOpacity>
                    </View>
                </View>

                {/* Title */}
                <View style = { [
                    css.flexOne, 
                    css.centerVerticaly, 
                    css.centerChildren,
                    css.p_ThreeLeft,                    
                ] }>                    
                    <Text style={ [ css.titleText, css.fontBebas, css.startHorizontaly ] }>{pageTitle}</Text>                    
                </View>

            </View>
        </SafeAreaView>
   );
 }
 
 export default HeaderNoDrawer;