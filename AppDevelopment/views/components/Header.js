/**
 * File DOC
 * 
 * @Description Componente de Cabeçalho padronizado que recebe alguns parâmetros, como Título.
 * @ChangeLog 
 *  - Vinícius Lessa - 24/05/2022: Criação do Arquivo e documentação de Cabeçalho.
 *  - Vinícius Lessa - 26/05/2022: Implementação do comportamento do MENU baseado em suas props. Botões já funcionais.
 * 
 */

 import React from 'react';  // JSX Compilation
 import {
   Text,
   View,
   SafeAreaView,
   TouchableOpacity , 
   Image,
   StatusBar
 } from 'react-native'; // Core Components
   
import { css } from '../../assets/css/css.js'; // Style - css

import * as Animatable from 'react-native-animatable'; // Animation  

import { MaterialIcons } from '@expo/vector-icons'; // Icons
 
// Left Icon
const openMenu = (props) => {
    props.navigation.openDrawer();
}

const HeaderDefault = (props) => {   
 
   const pageTitle      = props.title;   
   const userName       = props.userName;      
   const userPhotoURL   = props.userPhotoURL; 

    // Booleans
   const isLoggedUser   = props.isLoggedUser; 
   const hideRightIcon  = props.hideRightIcon;
    
   return (
    <SafeAreaView>
        <StatusBar/>
        <View style = { [ css.headerDefault ] }>

            {/* Menu */}
            <View style = { [ css.centerVerticaly ] }>
                <View style = { [ { alignSelf: 'flex-start' } ] }>
                    <TouchableOpacity
                        // Menu Drawer
                        onPress={()=>openMenu(props)}
                    >
                        <Image
                            source={require('../../assets/img/menu.png')}
                            style={ [ css.startHorizontaly , {
                                width: 60, height: 60, right: 15
                            }] }
                        />
                    </TouchableOpacity>
                </View>
            </View>

            {/* Title */}
            <View style = { [css.flexOne, css.centerVerticaly, css.centerChildren ] }>
                {/* <Animatable.View animation="fadeInLeft" delay={500} style={css.containerHeader}> */}
                    <Text style={ [ css.titleText, css.fontBebas, css.startHorizontaly ] }>{pageTitle}</Text>
                {/* </Animatable.View> */}
            </View>

            {/* Login / User */}
            {
                !hideRightIcon &&
                <View style = { [css.flexOne, css.centerVerticaly, css.centerChildren] }>                
                    <View style = { [ { alignSelf: 'flex-end', marginRight:8 } ] }>
                        <TouchableOpacity                    
                            onPress={()=>props.navigation.navigate('Entrar')}>

                            <Animatable.Image
                                animation="flipInY"
                                source={require('../../assets/img/signin.png')}
                                resizeMode = "contain"
                                style={{
                                    width: 55,
                                    height: 55,  
                                }}
                            />
                        </TouchableOpacity>
                    </View>
                </View>
            }
        </View>
    </SafeAreaView>
   );
 }
 
 export default HeaderDefault;