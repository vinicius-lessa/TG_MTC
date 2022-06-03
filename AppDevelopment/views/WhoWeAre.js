/**
 * File DOC
 * 
 * @Description Página 'Feed Musical', irá indicar músicas e artisitas ao usuários, além de notícias.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/06/2022: Criação da documentação de Cabeçalho e Criação da estrutura básica da Página.
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


const WhoWeAre = (props) => {

    return (
        <SafeAreaView style={css.container}>
            
            {/* Header */}
            <HeaderDefault 
                title="SOBRE"
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
                  Quem Somos  
                </Text>
            </View>

        </SafeAreaView>
    );
}

export default WhoWeAre;