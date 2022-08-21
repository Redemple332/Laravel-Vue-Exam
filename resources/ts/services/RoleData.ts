import http from "../http-common";
class RoleData {
  async getAll() {
    return http.get("/roles");
  }
  async get(id: string) {
    return http.get(`/role/edit/${id}`);
  }
  async create(data: any) {
    return http.post("/role/store", data);
  }
  async update(id: string | number, data: any) {
    return http.put(`/role/${id}`, data);
  }
  async delete(id:  string | number) {
    return http.delete(`/role/${id}`);
  }
}
export default new RoleData();