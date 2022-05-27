/**
 * File DOC
 * 
 * @Description Página 'Music Trade Center', Mostrando o perfil de outros usuários da Plataforma.
 * @ChangeLog 
 *  - Vinícius Lessa - 27/05/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 * 
 */

import React from 'react';  // JSX Compilation
import { 
    View ,
    Text ,
    SafeAreaView
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import { css } from '../assets/css/css.js'; // Style - css


const MusicTradeCenter = (props) => {

    return (
        <SafeAreaView style={css.container}>
            
            {/* Header */}
            <HeaderDefault 
                title="MUSIC TRADE CENTER"                
                userName={null}
                userPhotoURL={null}
                navigation={props.navigation}
                isLoggedUser={false}
                hideRightIcon={true}
            />
            
            <View style={ [ css.flexOne, css.centerVerticaly ]}>
                <Text style={ [
                    css.titleText ,
                    css.fontBebas
                ] }>
                    MUSIC TRADE CENTER
                </Text>
            </View>

        </SafeAreaView>
    );
}

export default MusicTradeCenter;