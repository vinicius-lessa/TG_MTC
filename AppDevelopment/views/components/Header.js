/**
 * File DOC
 * 
 * @Description Componente de Cabeçalho padronizado que recebe alguns parâmetros, como Título.
 * @ChangeLog 
 *  - Vinícius Lessa - 24/05/2022: Criação do Arquivo e documentação de Cabeçalho.
 * 
 */

 import React, { useState, useEffect } from 'react';  // JSX Compilation
 import {
   Text,
   View,
   SafeAreaView,
   TouchableOpacity ,
   StatusBar
 } from 'react-native'; // Core Components
   
 import { css } from '../../assets/css/css.js'; // Style - css
 
 import * as Animatable from 'react-native-animatable'; // Animation  
 
 const HeaderDefault = (props) => {   
 
   const pageTitle      = props.title;
   const isLoggedUser   = props.isLoggedUser; // Bool
   const userName       = props.userName;      
   const userPhotoURL   = props.userPhotoURL; 
    
   return (
    <SafeAreaView>
        <StatusBar/>
        <View style = {[            
            css.rowOrientation, 
            css.centerSelf,
            { width: '100%', minWidth: 100, minHeight: 100 } ]}>

            {/* Menu */}
            <View style = { [css.flexOne, css.centerVerticaly] }>
                <Text style={css.colorWhite}>
                    Menu
                </Text>
            </View>

            {/* Title */}
            <View style = { [css.flexTwo, css.centerVerticaly, css.centerChildren ] }>
                <Animatable.View animation="fadeInLeft" delay={500} style={css.containerHeader}>
                    <Text style={ [css.titleText, css.fontBebas] }>{pageTitle}</Text>
                </Animatable.View>
            </View>

            {/* Login / User */}
            <View style = { [css.flexOne, css.centerVerticaly, css.centerChildren] }>
                <TouchableOpacity                    
                    onPress={()=>props.navigation.navigate('SignIn')}>

                    <Animatable.Image
                        animation="flipInY"
                        source={require('../../assets/img/entrar.png')}
                        resizeMode = "contain"
                        style={{
                        width: 80,
                        height: 80,  
                        }}
                    />
                </TouchableOpacity>
            </View>
        </View>
    </SafeAreaView>
   );
 }
 
 export default HeaderDefault;