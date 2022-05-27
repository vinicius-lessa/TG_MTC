import AsyncStorageLib from "@react-native-async-storage/async-storage";
import { create } from "apisauce";

const api = create({
    baseURL: 'https://musictradecenter.000webhostapp.com/BackendDevelopment',
    timeout: 15000 , // 15 Segundos
});

// Client > Server
api.addAsyncRequestTransform(request => async () => {
    const token = await AsyncStorageLib.getItem('@MTC:token');

    if (token)
        request.headers['Authorization'] = `Bearer ${token}`;
});

// Server > Client
api.addResponseTransform(response => {
    //  true/false - http +400 = false
    if (!response.ok || response.data.error) throw response;
    
});

export default api;