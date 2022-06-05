/**
 * File DOC
 * 
 * @Description Página 'Chats', que irá exibir todas as Mensagens do usuário Logado.
 * @ChangeLog 
 *  - Vinícius Lessa - 05/06/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
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


const Chats = (props) => {

  return (
    <SafeAreaView style={css.container}>
        
      {/* Header */}
      <HeaderDefault 
        title="CHATS"                
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
            CHATS
        </Text>
      </View>

    </SafeAreaView>
  );
}

export default Chats;