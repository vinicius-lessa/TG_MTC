/**
 * File DOC
 * 
 * @Description Componente da Navegação Lateral do APP.
 * @ChangeLog 
 *  - Vinícius Lessa - 26/05/2022: Criação do Arquivo e documentação de Cabeçalho. Início da Estilização.
 * 
 */

 import React from 'react';  // JSX Compilation
 import {   
   View,
   Text,   
   ScrollView,   
   TouchableOpacity , 
   Image,      
 } from 'react-native'; // Core Components
   
import { css } from '../../assets/css/css.js'; // Style - css

import {
    DrawerContentScrollView,
    DrawerItemList,    
  } from '@react-navigation/drawer';

import { Ionicons } from '@expo/vector-icons'; // Icons


const SideBar = (props) => {
   return (
        <DrawerContentScrollView>
            <View sytle={ [ css.flexOne, css.bkBlue ] }>
                <View sytle={ [ ] }>
                    <Ionicons name="person-circle-sharp" size={24} color="black" />
                    <Text sttle = { css.size22 }>Entrar</Text>
                </View>
            </View>
            <DrawerItemList {...props} />
        </DrawerContentScrollView>
    );
}

export default SideBar;