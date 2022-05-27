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

// Icons
import { Ionicons } from '@expo/vector-icons';
import { AntDesign } from '@expo/vector-icons';


const SideBar = (props) => {
    
    // console.log(props);

    return (
        <ScrollView style={ [ { backgroundColor: '#dadada' } ] }>
            <DrawerContentScrollView>
                <View style={ [ css.rowOrientation ] }>
                    <View style={ [ css.centerSelf, css.flexOne ] }>
                        <Ionicons style={ [ css.endtHorizontaly ] } name="person-circle-sharp" size={100} color="#eb1f36" />
                    </View>
                    <View style={ [ css.centerSelf, css.flexOne ] }>
                        <TouchableOpacity onPress={()=>props.navigation.navigate('Entrar')}>
                            <Text style = { [css.size24, css.textRed] }>ENTRAR</Text>
                        </TouchableOpacity>
                    </View>
                </View>

                <View style={ css.hrLightGrey } />
                
                <View style={ [ {paddingHorizontal: 10} ] }>
                    <View style={css.rowOrientation}>
                        <Text style = { [css.size24, css.textBlack, css.fontBebas, css.m_ThreeLeft, css.m_ThreeY] }>Navegação</Text>
                        <AntDesign name="down" size={20} color="black" style={{ top: 18, left: 10 }} />
                    </View>

                    {/* <TouchableOpacity onPress={()=>props.navigation.navigate('Anúncios')}>
                        <Text style = { [css.size24, css.textRed] }>Anúncios</Text>
                    </TouchableOpacity> */}

                    <DrawerItemList
                        {...props}
                    />
                </View>
                
            </DrawerContentScrollView>
        </ScrollView>
    );
}

export default SideBar;