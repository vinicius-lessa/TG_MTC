/**
 * File DOC
 * 
 * @Description Página 'Music Trade Center', Mostrando o perfil de outros usuários da Plataforma.
 * @ChangeLog 
 *  - Vinícius Lessa - 02/06/2022: Criação do Arquivo e documentação de Cabeçalho. Cópia da estrutura utilizada localmente nos arquivos.
 * 
 */

import React from 'react';  // JSX Compilation
import { 
    View ,
    ActivityIndicator ,
} from 'react-native'; // Core Components

import { css } from '../../assets/css/css.js'; // Style - css 

// Loading Component
const LoadingIcon = () => {
    return (
      <View style={css.container}>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
          <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
          </View>
        </View>
      </View>
    );
};

export default LoadingIcon;